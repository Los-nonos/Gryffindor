import { Request } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import DeleteHostelCommand from '../../../../Application/Commands/Hostel/DeleteHostelCommand';
import { DeleteHostelSchema } from '../../Validator/Schemas/HostelSchema';

@injectable()
class DeleteHostelAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<DeleteHostelCommand> {
    const error = this.validator.validate(req.params, DeleteHostelSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new DeleteHostelCommand(Number(req.params.id));
  }
}

export default DeleteHostelAdapter;
