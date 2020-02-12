import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Validator from '../../Validator/Validator';
import { BadRequest } from '../../Errors/BadRequest';
import FindByIdRoomCommand from '../../../../Application/Commands/Room/FindByIdRoomCommand';
import { FindByIdRoomSchema } from '../../Validator/Schemas/RoomSchema';

@injectable()
class FindByIdRoomAdapter {
  private validator: Validator;
  constructor(@inject(Validator) validator: Validator) {
    this.validator = validator;
  }
  public async from(req: Request): Promise<FindByIdRoomCommand> {
    const error = this.validator.validate(req.params, FindByIdRoomSchema);
    if (error) {
      throw new BadRequest(JSON.stringify(this.validator.validationResult(error)));
    }
    return new FindByIdRoomCommand(Number(req.params.id));
  }
}

export default FindByIdRoomAdapter;
