import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/Auth/LoginPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import LoginAdapter from '../../Adapters/Auth/LoginAdapter';
import LoginHandler from '../../../../Application/Handlers/Auth/LoginHandler';
import LoginCommand from '../../../../Application/Commands/Auth/LoginCommand';

@injectable()
class LoginAction {
  private adapter: LoginAdapter;
  private handler: LoginHandler;
  constructor(@inject(LoginAdapter) adapter: LoginAdapter, @inject(LoginHandler) handler: LoginHandler) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: LoginCommand = await this.adapter.from(req);
    //TODO: Change any for concrete values
    const { user, token }: any = await this.handler.execute(command);
    const presenter = new Presenter(user, token);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'Auth founds'));
  }
}

export default LoginAction;
