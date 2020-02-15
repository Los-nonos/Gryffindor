import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import DeleteUserAdapter from '../../Adapters/User/DeleteUserAdapter';
import DeleteUserHandler from '../../../../Application/Handlers/User/DeleteUserHandler';
import DeleteUserCommand from '../../../../Application/Commands/User/DeleteUserCommand';

@injectable()
class DeleteUserAction {
  private adapter: DeleteUserAdapter;
  private handler: DeleteUserHandler;
  constructor(
    @inject(DeleteUserAdapter) adapter: DeleteUserAdapter,
    @inject(DeleteUserHandler) handler: DeleteUserHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: DeleteUserCommand = await this.adapter.from(req);
    await this.handler.execute(command);

    res.status(HTTP_CODES.NO_CONTENT).end();
  }
}

export default DeleteUserAction;
