import { BaseError } from '../../API/Http/Errors/BaseError';

export class InfraestructureError extends BaseError {
  protected statusCode: number;

  constructor(message: string | object, statusCode: number) {
    super(message);
    this.statusCode = statusCode;
  }

  getStatusCode(): number {
    return this.statusCode;
  }
}
