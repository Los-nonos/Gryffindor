import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/null';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import DeleteRoomAdapter from '../../Adapter/Room/DeleteRoomAdapter';
import DeleteRoomHandler from '../../../../Application/Handlers/Room/DeleteRoomHandler';

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
    const command: any = this.adapter.from(req);
    const response: any = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), null));
  }
}

export default DeleteRoomAction;
