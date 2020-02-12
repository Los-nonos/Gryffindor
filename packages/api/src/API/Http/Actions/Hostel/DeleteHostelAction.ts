import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import DeleteHostelAdapter from '../../Adapters/Hostel/DeleteHostelAdapter';
import DeleteHostelHandler from '../../../../Application/Handlers/Hostel/DeleteHostelHandler';
import DeleteHostelCommand from '../../../../Application/Commands/Hostel/DeleteHostelCommand';

@injectable()
class DeleteHostelAction {
  private adapter: DeleteHostelAdapter;
  private handler: DeleteHostelHandler;
  constructor(
    @inject(DeleteHostelAdapter) adapter: DeleteHostelAdapter,
    @inject(DeleteHostelHandler) handler: DeleteHostelHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: DeleteHostelCommand = await this.adapter.from(req);
    await this.handler.execute(command);

    res.status(HTTP_CODES.NO_CONTENT).end();
  }
}

export default DeleteHostelAction;
