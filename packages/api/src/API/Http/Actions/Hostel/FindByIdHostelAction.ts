import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/Hostel/FindByIdHostelPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindByIdHostelAdapter from '../../Adapters/Hostel/FindByIdHostelAdapter';
import FindByIdHostelHandler from '../../../../Application/Handlers/Hostel/FindByIdHostelHandler';

@injectable()
class FindByIdHostelAction {
  private adapter: FindByIdHostelAdapter;
  private handler: FindByIdHostelHandler;
  constructor(
    @inject(FindByIdHostelAdapter) adapter: FindByIdHostelAdapter,
    @inject(FindByIdHostelHandler) handler: FindByIdHostelHandler,
  ) {
    this.adapter = adapter;
    this.handler = handler;
  }
  public async execute(req: Request, res: Response) {
    const command: any = await this.adapter.from(req);
    const response: any = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'Hostel found'));
  }
}

export default FindByIdHostelAction;
