import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import FindByIdUserCommand from '../../../../Application/Commands/User/FindByIdUserCommand';
import { IdSchema } from '../../Validator/Schemas/Common';

@injectable()
class FindByIdUserAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<FindByIdUserCommand> {
    const error = this.validator.validate(req.params, IdSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new FindByIdUserCommand(req.body);
  }
}

export default FindByIdUserAdapter;
