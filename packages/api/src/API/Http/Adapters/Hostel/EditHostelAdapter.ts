import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import EditHostelCommand from '../../../../Application/Commands/Hostel/EditHostelCommand';
import {EditHostelSchema} from '../../Validator/Schemas/HostelSchema';

@injectable()
class EditHostelAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<EditHostelCommand> {
    const error = this.validator.validate(req.body, EditHostelSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new EditHostelCommand(req.body.id, req.body.name, req.body.email, req.body.address, req.body.cuit, req.body.password, req.body.tinyDescription);
  }
}

export default EditHostelAdapter;
