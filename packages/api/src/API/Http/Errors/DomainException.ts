import { InfraestructureError } from '../../../Infraestructure/Errors/InfraestructureError';

class DomainException extends InfraestructureError {
  constructor(message: string) {
    super(message, 500);
  }
}

export default DomainException;
