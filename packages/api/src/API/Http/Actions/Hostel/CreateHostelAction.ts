import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/Hostel/CreateHostelPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import CreateHostelAdapter from '../../Adapters/Hostel/CreateHostelAdapter';
import CreateHostelHandler from '../../../../Application/Handlers/Hostel/CreateHostelHandler';
import CreateHostelCommand from '../../../../Application/Commands/Hostel/CreateHostelCommand';
import Hostel from '../../../../Domain/Entities/Hostel';

@injectable()
class CreateHostelAction {
  private adapter: CreateHostelAdapter;
  private handler: CreateHostelHandler;
  constructor(
    @inject(CreateHostelAdapter) adapter: CreateHostelAdapter,
    @inject(CreateHostelHandler) handler: CreateHostelHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: CreateHostelCommand = await this.adapter.from(req);
    const response: Hostel = await this.handler.execute(command);

    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), null));
  }
}

export default CreateHostelAction;
