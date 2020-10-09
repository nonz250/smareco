<?php
declare(strict_types=1);

namespace App\Adapters\Customers\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;
use Smareco\Customers\Models\Services\AIServiceInterface;
use Smareco\Exceptions\SmarecoSpecificationException;
use Throwable;

class AIService implements AIServiceInterface
{
    /**
     * @var Client
     */
    private Client $client;
    private string $apiKey;
    private string $notificationURL;

    /**
     * AIService constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function setNotificationURL(string $url)
    {
        $this->notificationURL = $url;
    }

    /**
     * @throws SmarecoSpecificationException
     * @return string
     */
    public function getPostEndpoint(): string
    {
        $headers = [];
        $query = http_build_query([
            'apikey' => (string) $this->apiKey,
        ]);
        $request = new Request(
            'GET',
            config('smareco.ai.get_ai_post_endpoint') . '?' . $query,
            $headers
        );
        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            $message = $this->getErrorMessage($e);
            throw new SmarecoSpecificationException($message ?? 'CSVアップロード用エンドポイントを取得できませんでした。', $e->getCode(), $e);
        }
        $responseBody = json_decode($response->getBody()->getContents(), true);
        $endpoint = $responseBody['result']['url'] ?? '';
        if ($endpoint === '') {
            throw new SmarecoSpecificationException('CSVアップロード用エンドポイントを取得できませんでした。');
        }
        return $endpoint;
    }

    /**
     * @param string $postEndpoint
     * @param string $csvPath
     * @throws SmarecoSpecificationException
     */
    public function uploadCsv(string $postEndpoint, string $csvPath): void
    {
        $headers = [];
        $request = new Request('PUT', $postEndpoint, $headers, Storage::get($csvPath));
        try {
            $this->client->send($request);
        } catch (GuzzleException $e) {
            $message = $this->getErrorMessage($e);
            throw new SmarecoSpecificationException($message ?? 'CSVをアップロードできませんでした。', $e->getCode(), $e);
        }
    }

    /**
     * @throws SmarecoSpecificationException
     */
    public function analyze(): void
    {
        $headers = [];
        $query = [
            'apikey' => (string) $this->apiKey,
            'payload' => (string) '{ "_url": "' . $this->notificationURL . '" }',
        ];
        if (mb_strlen($this->notificationURL) === 0) {
            unset($query['payload']);
        }
        $query = http_build_query($query);
        $request = new Request(
            'GET',
            config('smareco.ai.analyze_endpoint') . '?' . $query,
            $headers
        );
        try {
            $this->client->send($request);
        } catch (GuzzleException $e) {
            $message = $this->getErrorMessage($e);
            throw new SmarecoSpecificationException($message ?? '分析を開始できませんでした。', $e->getCode(), $e);
        }
    }

    /**
     * @throws SmarecoSpecificationException
     * @return string
     */
    public function getAnalyzeStatus(): string
    {
        $headers = [];
        $query = http_build_query([
            'apikey' => (string) $this->apiKey,
        ]);
        $request = new Request(
            'GET',
            config('smareco.ai.get_analyze_status_endpoint') . '?' . $query,
            $headers
        );
        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            $message = $this->getErrorMessage($e);
            throw new SmarecoSpecificationException($message ?? '演算ステータスを取得できませんでした。', $e->getCode(), $e);
        }
        $responseBody = json_decode($response->getBody()->getContents(), true);
        $message = $responseBody['result']['message'] ?? '';
        if ($message === '') {
            throw new SmarecoSpecificationException('演算ステータスを取得できませんでした。');
        }
        return $message;
    }

    public function getResultEndpoint(): string
    {
        // TODO: Implement getResultEndpoint() method.
    }

    public function result(): void
    {
        // TODO: Implement result() method.
    }

    private function getErrorMessage(Throwable $exception): string
    {
        $message = $exception->getMessage();
        if ($exception->getCode() === 400) {
            if (mb_strpos($message, 'api busy')) {
                return 'ビジー状態です。しばらく経ってからお試しください。';
            }
            if (mb_strpos($message, 'webhook error')) {
                return 'Webhookエンドポイントが適切ではありません。';
            }
        } elseif ($exception->getCode() === 500) {
            if (mb_strpos($message, 'server error')) {
                return 'AIサーバーでエラーが発生しました。';
            }
        }
        return '';
    }
}
