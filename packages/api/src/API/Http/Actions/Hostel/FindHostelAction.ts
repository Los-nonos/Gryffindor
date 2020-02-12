import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/Hostel/FindHostelPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindHostelAdapter from '../../Adapters/Hostel/FindHostelAdapter';
import FindHostelHandler from '../../../../Application/Handlers/Hostel/FindHostelHandler';

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
    const command: any = await this.adapter.from(req);
    const response: any = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'Hostels found'));
  }
}

export default FindHostelAction;
