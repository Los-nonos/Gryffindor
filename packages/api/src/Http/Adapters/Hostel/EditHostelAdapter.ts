import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import EditHostelCommand from '../../../../Application/Commands/Hostel/EditHostelCommand';
import HostelSchema from '../../Validator/Schemas/HostelSchema';

@injectable()
class EditHostelAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<EditHostelCommand> {
    const error = this.validator.validate(req.body, HostelSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new EditHostelCommand(req.body);
  }
}

export default EditHostelAdapter;
