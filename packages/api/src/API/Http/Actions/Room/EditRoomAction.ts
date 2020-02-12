import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenter/Room/EditRoomPresenter';
import { success } from '../../Presenter/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import EditRoomAdapter from '../../Adapters/Room/EditRoomAdapter';
import EditRoomHandler from '../../../../Application/Handlers/Room/EditRoomHandler';
import EditRoomCommand from '../../../../Application/Commands/Room/EditRoomCommand';
import Room from '../../../../Domain/Entities/Room';

@injectable()
class EditRoomAction {
  private adapter: EditRoomAdapter;
  private handler: EditRoomHandler;
  constructor(@inject(EditRoomAdapter) adapter: EditRoomAdapter, @inject(EditRoomHandler) handler: EditRoomHandler) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: EditRoomCommand = await this.adapter.from(req);
    const response: Room = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'rooms founds'));
  }
}

export default EditRoomAction;
