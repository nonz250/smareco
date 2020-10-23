import AnalyzeRepository from '../Repositories/AnalyzeRepository';

class GetAnalyze {
  constructor() {
    this.analyzeRepository = new AnalyzeRepository();
  }

  async process() {
    const result = await this.analyzeRepository.get();
    if (result === false) {
      throw this.analyzeRepository.error;
    }
    return result;
  }
}

export default GetAnalyze;
