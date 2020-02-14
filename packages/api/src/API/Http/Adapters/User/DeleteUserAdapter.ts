import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import DeleteUserCommand from '../../../../Application/Commands/User/DeleteUserCommand';
import { IdSchema } from '../../Validator/Schemas/Common';

@injectable()
class DeleteUserAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<DeleteUserCommand> {
    const error = this.validator.validate(req.params, IdSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new DeleteUserCommand(req.body);
  }
}

export default DeleteUserAdapter;
