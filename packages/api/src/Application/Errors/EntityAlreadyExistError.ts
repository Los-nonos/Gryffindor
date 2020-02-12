import { InfraestructureError } from '../../Infraestructure/Errors/InfraestructureError';
import { HTTP_CODES } from '../../API/Http/Enums/HttpCodes';

export class EntityAlreadyExistError extends InfraestructureError {
  constructor(message: string) {
    super(message, HTTP_CODES.UNPROCESSABLE_ENTITY);
  }
}
