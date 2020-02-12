import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/Hostel/FindHostelPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindHostelAdapter from '../../Adapters/Hostel/FindHostelAdapter';
import FindHostelHandler from '../../../../Application/Handlers/Hostel/FindHostelHandler';
import FindHostelCommand from '../../../../Application/Commands/Hostel/FindHostelCommand';
import Hostel from '../../../../Domain/Entities/Hostel';

@injectable()
class FindHostelAction {
  private adapter: FindHostelAdapter;
  private handler: FindHostelHandler;
  constructor(
    @inject(FindHostelAdapter) adapter: FindHostelAdapter,
    @inject(FindHostelHandler) handler: FindHostelHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: FindHostelCommand = await this.adapter.from(req);
    const response: Hostel[] = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'Hostels found'));
  }
}

export default FindHostelAction;
