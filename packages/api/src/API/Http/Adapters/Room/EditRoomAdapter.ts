import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import EditRoomCommand from '../../../../Application/Commands/Room/EditRoomCommand';
import { EditRoomSchema } from '../../Validator/Schemas/RoomSchema';
import { IdSchema } from '../../Validator/Schemas/IdSchema';

@injectable()
class EditRoomAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<EditRoomCommand> {
    const error = this.validator.validate(req.body, EditRoomSchema);
    const errorId = this.validator.validate(req.params, IdSchema);

    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }

    if (errorId) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(errorId)));
    }

    return new EditRoomCommand(Number(req.params.id), req.body.name);
  }
}

export default EditRoomAdapter;
