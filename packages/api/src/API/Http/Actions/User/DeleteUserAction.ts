import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/User/DeleteUserPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import DeleteUserAdapter from '../../Adapters/User/DeleteUserAdapter';
import DeleteUserHandler from '../../../../Application/Handlers/User/DeleteUserHandler';

@injectable()
class DeleteUserAction
{
	private adapter: DeleteUserAdapter;
	private handler: DeleteUserHandler;
	constructor(@inject(DeleteUserAdapter) adapter: DeleteUserAdapter, @inject(DeleteUserHandler) handler: DeleteUserHandler) {
		this.adapter = adapter;
		this.handler = handler;
	}
	public async execute(req: Request, res: Response) {
		const command: any = this.adapter.from(req);
		const response: any = await this.handler.execute(command);
		const presenter = new Presenter(response);

		res.status(HTTP_CODES.OK).json(success(presenter.getData(), User founds));
	}
}

export default DeleteUserAction;
