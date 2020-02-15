import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/Auth/LoginPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import LoginAdapter from '../../Adapters/Auth/LoginAdapter';
import LoginHandler from '../../../../Application/Handlers/Auth/LoginHandler';

@injectable()
class LoginAction {
  private adapter: LoginAdapter;
  private handler: LoginHandler;
  constructor(@inject(LoginAdapter) adapter: LoginAdapter, @inject(LoginHandler) handler: LoginHandler) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: any = this.adapter.from(req);
    const response: any = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'Auth founds'));
  }
}

export default LoginAction;
