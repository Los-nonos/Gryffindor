import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/User/FindUserPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindUserAdapter from '../../Adapters/User/FindUserAdapter';
import FindUserHandler from '../../../../Application/Handlers/User/FindUserHandler';

@injectable()
class FindUserAction {
  private adapter: FindUserAdapter;
  private handler: FindUserHandler;
  constructor(@inject(FindUserAdapter) adapter: FindUserAdapter, @inject(FindUserHandler) handler: FindUserHandler) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: any = this.adapter.from(req);
    const response: any = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'Users founds'));
  }
}

export default FindUserAction;
