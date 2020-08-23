<?php
declare(strict_types=1);

namespace App\Http\Controllers\Actions\Smaregi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Smaregi\SmaregiUserAuthRequest;
use Illuminate\Http\RedirectResponse;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Throwable;

class SmaregiUserAuthAction extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SmaregiUserAuthRequest $request
     * @throws SmarecoSpecificationExceptionInterface
     * @throws Throwable
     * @return RedirectResponse
     */
    public function __invoke(SmaregiUserAuthRequest $request)
    {
        try {
        } catch (SmarecoSpecificationExceptionInterface $e) {
            throw $e;
        } catch (Throwable $e) {
            throw $e;
        }
        return redirect()->route('top');
    }
}
