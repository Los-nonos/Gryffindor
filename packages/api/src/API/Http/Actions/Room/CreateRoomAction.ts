import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenter/Room/CreateRoomPresenter';
import { success } from '../../Presenter/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import CreateRoomAdapter from '../../Adapters/Room/CreateRoomAdapter';
import CreateRoomHandler from '../../../../Application/Handlers/Room/CreateRoomHandler';
import CreateRoomCommand from '../../../../Application/Commands/Room/CreateRoomCommand';
import Room from '../../../../Domain/Entities/Room';

@injectable()
class CreateRoomAction {
  private adapter: CreateRoomAdapter;
  private handler: CreateRoomHandler;
  constructor(
    @inject(CreateRoomAdapter) adapter: CreateRoomAdapter,
    @inject(CreateRoomHandler) handler: CreateRoomHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: CreateRoomCommand = await this.adapter.from(req);
    const response: Room = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), null));
  }
}

export default CreateRoomAction;
