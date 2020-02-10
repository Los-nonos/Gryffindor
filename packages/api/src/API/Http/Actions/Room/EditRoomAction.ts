import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/null';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import EditRoomAdapter from '../../Adapter/Room/EditRoomAdapter';
import EditRoomHandler from '../../../../Application/Handlers/Room/EditRoomHandler';

@injectable()
class EditRoomAction
{
	private adapter: EditRoomAdapter;
	private handler: EditRoomHandler;
	constructor(@inject(EditRoomAdapter) adapter: EditRoomAdapter, @inject(EditRoomHandler) handler: EditRoomHandler) {
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

export default EditRoomAction;
