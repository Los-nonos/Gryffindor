import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/null';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindByIdRoomAdapter from '../../Adapter/Room/FindByIdRoomAdapter';
import FindByIdRoomHandler from '../../../../Application/Handlers/Room/FindByIdRoomHandler';

@injectable()
class FindByIdRoomAction
{
	private adapter: FindByIdRoomAdapter;
	private handler: FindByIdRoomHandler;
	constructor(@inject(FindByIdRoomAdapter) adapter: FindByIdRoomAdapter, @inject(FindByIdRoomHandler) handler: FindByIdRoomHandler) {
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

export default FindByIdRoomAction;
