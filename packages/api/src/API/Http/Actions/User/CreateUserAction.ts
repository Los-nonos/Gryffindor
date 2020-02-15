import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/User/CreateUserPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import CreateUserAdapter from '../../Adapters/User/CreateUserAdapter';
import CreateUserHandler from '../../../../Application/Handlers/User/CreateUserHandler';
import CreateUserCommand from '../../../../Application/Commands/User/CreateUserCommand';
import User from '../../../../Domain/Entities/User';

@injectable()
class CreateUserAction {
  private adapter: CreateUserAdapter;
  private handler: CreateUserHandler;
  constructor(
    @inject(CreateUserAdapter) adapter: CreateUserAdapter,
    @inject(CreateUserHandler) handler: CreateUserHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: CreateUserCommand = await this.adapter.from(req);
    const response: User = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'User created satisfully'));
  }
}

export default CreateUserAction;
