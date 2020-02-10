import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import EditRoomCommand from '../../../../Application/Commands/Room/EditRoomCommand';
import { EditRoomSchema } from '../../Validator/Schemas/RoomSchema';

@injectable()
class EditRoomAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<EditRoomCommand> {
    const error = this.validator.validate(req.body, EditRoomSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new EditRoomCommand(req.body.id, req.body.name);
  }
}

export default EditRoomAdapter;
