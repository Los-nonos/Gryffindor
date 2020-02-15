import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import ChangePasswordAdapter from '../../Adapters/Auth/ChangePasswordAdapter';
import ChangePasswordHandler from '../../../../Application/Handlers/Auth/ChangePasswordHandler';

@injectable()
class ChangePasswordAction {
  private adapter: ChangePasswordAdapter;
  private handler: ChangePasswordHandler;
  constructor(
    @inject(ChangePasswordAdapter) adapter: ChangePasswordAdapter,
    @inject(ChangePasswordHandler) handler: ChangePasswordHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: any = this.adapter.from(req);
    
    await this.handler.execute(command);

    res.status(HTTP_CODES.NO_CONTENT).end()
  }
}

export default ChangePasswordAction;
