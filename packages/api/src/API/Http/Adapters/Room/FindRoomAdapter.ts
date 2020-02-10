import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import FindRoomCommand from '../../../../Application/Commands/Room/FindRoomCommand';
import { FindRoomSchema } from '../../Validator/Schemas/RoomSchema';

@injectable()
class FindRoomAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<FindRoomCommand> {
    const error = this.validator.validate(req.body, FindRoomSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new FindRoomCommand(req.body.id, req.body.name);
  }
}

export default FindRoomAdapter;
