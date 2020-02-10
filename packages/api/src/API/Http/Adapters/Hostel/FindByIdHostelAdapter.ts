import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import FindByIdHostelCommand from '../../../../Application/Commands/Hostel/FindByIdHostelCommand';
import HostelSchema from '../../Validator/Schemas/HostelSchema';

@injectable()
class FindByIdHostelAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<FindByIdHostelCommand> {
    const error = this.validator.validate(req.body, HostelSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new FindByIdHostelCommand(req.body);
  }
}

export default FindByIdHostelAdapter;
