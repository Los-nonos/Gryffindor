import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import CreateHostelCommand from '../../../../Application/Commands/Hostel/CreateHostelCommand';
import { CreateHostelSchema } from '../../Validator/Schemas/HostelSchema';

@injectable()
class CreateHostelAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<CreateHostelCommand> {
    const error = this.validator.validate(req.body, CreateHostelSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new CreateHostelCommand(
      req.body.id,
      req.body.name,
      req.body.email,
      req.body.address,
      req.body.cuit,
      req.body.password,
      req.body.tinyDescription,
    );
  }
}

export default CreateHostelAdapter;
