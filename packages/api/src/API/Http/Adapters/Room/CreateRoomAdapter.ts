import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import CreateRoomCommand from '../../../../Application/Commands/Room/CreateRoomCommand';
import { CreateRoomSchema } from '../../Validator/Schemas/RoomSchema';

@injectable()
class CreateRoomAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<CreateRoomCommand> {
    const error = this.validator.validate(req.body, CreateRoomSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new CreateRoomCommand(req.body.id, req.body.name);
  }
}

export default CreateRoomAdapter;
