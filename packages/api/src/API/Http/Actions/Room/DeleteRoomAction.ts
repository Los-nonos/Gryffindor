import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import DeleteRoomAdapter from '../../Adapters/Room/DeleteRoomAdapter';
import DeleteRoomHandler from '../../../../Application/Handlers/Room/DeleteRoomHandler';
import DeleteRoomCommand from '../../../../Application/Commands/Room/DeleteRoomCommand';

@injectable()
class DeleteRoomAction {
  private adapter: DeleteRoomAdapter;
  private handler: DeleteRoomHandler;
  constructor(
    @inject(DeleteRoomAdapter) adapter: DeleteRoomAdapter,
    @inject(DeleteRoomHandler) handler: DeleteRoomHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: DeleteRoomCommand = await this.adapter.from(req);
    await this.handler.execute(command);

    res.status(HTTP_CODES.NO_CONTENT).end();
  }
}

export default DeleteRoomAction;
