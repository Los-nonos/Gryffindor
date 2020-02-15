import { Request } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import ChangePasswordCommand from '../../../../Application/Commands/Auth/ChangePasswordCommand';
import { ChangePasswordSchema } from '../../Validator/Schemas/AuthSchema';

@injectable()
class ChangePasswordAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<ChangePasswordCommand> {
    const error = this.validator.validate(req.body, ChangePasswordSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new ChangePasswordCommand(req.body.id, req.body.oldPassword, req.body.newPassword);
  }
}

export default ChangePasswordAdapter;
