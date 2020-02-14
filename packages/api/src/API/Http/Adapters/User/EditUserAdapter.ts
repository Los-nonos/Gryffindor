import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import EditUserCommand from '../../../../Application/Commands/User/EditUserCommand';
import EditUserSchema from '../../Validator/Schemas/UserSchema';

@injectable()
class EditUserAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<EditUserCommand> {
    const error = this.validator.validate(req.body, EditUserSchema);
    const errorId = this.validator.validate(req.params, IdSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    if (errorId) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(errorId)));
    }
    return new EditUserCommand(req.body);
  }
}

export default EditUserAdapter;
