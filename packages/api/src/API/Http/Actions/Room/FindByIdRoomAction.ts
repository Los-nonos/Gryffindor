import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenter/Room/FindByIdRoomPresenter';
import { success } from '../../Presenter/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindByIdRoomAdapter from '../../Adapters/Room/FindByIdRoomAdapter';
import FindByIdRoomHandler from '../../../../Application/Handlers/Room/FindByIdRoomHandler';
import FindByIdRoomCommand from '../../../../Application/Commands/Room/FindByIdRoomCommand';
import Room from '../../../../Domain/Entities/Room';

@injectable()
class FindByIdRoomAction {
  private adapter: FindByIdRoomAdapter;
  private handler: FindByIdRoomHandler;
  constructor(
    @inject(FindByIdRoomAdapter) adapter: FindByIdRoomAdapter,
    @inject(FindByIdRoomHandler) handler: FindByIdRoomHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: FindByIdRoomCommand = await this.adapter.from(req);
    const response: Room = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), null));
  }
}

export default FindByIdRoomAction;
