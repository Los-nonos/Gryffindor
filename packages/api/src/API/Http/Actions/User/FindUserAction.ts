import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/User/FindUserPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindUserAdapter from '../../Adapters/User/FindUserAdapter';
import FindUserHandler from '../../../../Application/Handlers/User/FindUserHandler';
import FindUserCommand from '../../../../Application/Commands/User/FindUserCommand';
import User from '../../../../Domain/Entities/User';

@injectable()
class FindUserAction {
  private adapter: FindUserAdapter;
  private handler: FindUserHandler;
  constructor(@inject(FindUserAdapter) adapter: FindUserAdapter, @inject(FindUserHandler) handler: FindUserHandler) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: FindUserCommand = await this.adapter.from(req);
    const response: User[] = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'Users founds'));
  }
}

export default FindUserAction;
