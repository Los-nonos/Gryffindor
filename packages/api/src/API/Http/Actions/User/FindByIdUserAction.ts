import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/User/FindByIdUserPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindByIdUserAdapter from '../../Adapters/User/FindByIdUserAdapter';
import FindByIdUserHandler from '../../../../Application/Handlers/User/FindByIdUserHandler';

@injectable()
class FindByIdUserAction {
  private adapter: FindByIdUserAdapter;
  private handler: FindByIdUserHandler;
  constructor(
    @inject(FindByIdUserAdapter) adapter: FindByIdUserAdapter,
    @inject(FindByIdUserHandler) handler: FindByIdUserHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: any = this.adapter.from(req);
    const response: any = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'User found'));
  }
}

export default FindByIdUserAction;
