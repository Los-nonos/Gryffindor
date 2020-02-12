import { Request } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import EditHostelCommand from '../../../../Application/Commands/Hostel/EditHostelCommand';
import { EditHostelSchema } from '../../Validator/Schemas/HostelSchema';
import { IdSchema } from '../../Validator/Schemas/IdSchema';

@injectable()
class EditHostelAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<EditHostelCommand> {
    const errorId = this.validator.validate(req.params, IdSchema);
    const error = this.validator.validate(req.body, EditHostelSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    if (errorId) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(errorId)));
    }
    return new EditHostelCommand(
      Number(req.params.id),
      req.body.name,
      req.body.email,
      req.body.address,
      req.body.cuit,
      req.body.password,
      req.body.tinyDescription,
    );
  }
}

export default EditHostelAdapter;
