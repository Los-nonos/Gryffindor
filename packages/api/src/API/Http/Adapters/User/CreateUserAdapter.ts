import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import CreateUserCommand from '../../../../Application/Commands/User/CreateUserCommand';
import CreateUserSchema from '../../Validator/Schemas/UserSchema';

@injectable()
class CreateUserAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<CreateUserCommand> {
    const error = this.validator.validate(req.body, CreateUserSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new CreateUserCommand(req.body);
  }
}

export default CreateUserAdapter;
