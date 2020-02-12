import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import DeleteRoomCommand from '../../../../Application/Commands/Room/DeleteRoomCommand';
import { DeleteRoomSchema } from '../../Validator/Schemas/RoomSchema';

@injectable()
class DeleteRoomAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<DeleteRoomCommand> {
    const error = this.validator.validate(req.params, DeleteRoomSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new DeleteRoomCommand(Number(req.params.id));
  }
}

export default DeleteRoomAdapter;
