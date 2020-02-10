import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import FindHostelCommand from '../../../../Application/Commands/Hostel/FindHostelCommand';
import HostelSchema from '../../Validator/Schemas/HostelSchema';

@injectable()
class FindHostelAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<FindHostelCommand> {
    const error = this.validator.validate(req.body, HostelSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new FindHostelCommand(req.body.id, req.body.name, req.body.email, req.body.address, req.body.cuit, req.body.password, req.body.tinyDescription);
  }
}

export default FindHostelAdapter;
