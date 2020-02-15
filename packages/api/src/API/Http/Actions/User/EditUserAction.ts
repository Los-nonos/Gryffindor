import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/User/EditUserPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import EditUserAdapter from '../../Adapters/User/EditUserAdapter';
import EditUserHandler from '../../../../Application/Handlers/User/EditUserHandler';
import EditUserCommand from '../../../../Application/Commands/User/EditUserCommand';
import User from '../../../../Domain/Entities/User';

@injectable()
class EditUserAction {
  private adapter: EditUserAdapter;
  private handler: EditUserHandler;
  constructor(@inject(EditUserAdapter) adapter: EditUserAdapter, @inject(EditUserHandler) handler: EditUserHandler) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: EditUserCommand = await this.adapter.from(req);
    const response: User = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'User updated sucessfully'));
  }
}

export default EditUserAction;
