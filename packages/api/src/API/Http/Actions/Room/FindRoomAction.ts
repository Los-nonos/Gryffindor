import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/null';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindRoomAdapter from '../../Adapter/Room/FindRoomAdapter';
import FindRoomHandler from '../../../../Application/Handlers/Room/FindRoomHandler';

@injectable()
class FindRoomAction {
  private adapter: FindRoomAdapter;
  private handler: FindRoomHandler;
  constructor(@inject(FindRoomAdapter) adapter: FindRoomAdapter, @inject(FindRoomHandler) handler: FindRoomHandler) {
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

export default FindRoomAction;
