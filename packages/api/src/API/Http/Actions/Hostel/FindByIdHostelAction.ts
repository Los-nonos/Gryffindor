import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import Presenter from '../../Presenters/Hostel/FindByIdHostelPresenter';
import { success } from '../../Presenters/Base/success';
import { HTTP_CODES } from '../../Enums/HttpCodes';
import FindByIdHostelAdapter from '../../Adapters/Hostel/FindByIdHostelAdapter';
import FindByIdHostelHandler from '../../../../Application/Handlers/Hostel/FindByIdHostelHandler';
import FindByIdHostelCommand from '../../../../Application/Commands/Hostel/FindByIdHostelCommand';
import Hostel from '../../../../Domain/Entities/Hostel';

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
    const command: FindByIdHostelCommand = await this.adapter.from(req);
    const response: Hostel = await this.handler.execute(command);
    const presenter = new Presenter(response);

    res.status(HTTP_CODES.OK).json(success(presenter.getData(), 'Hostel found'));
  }
}

export default FindByIdHostelAction;
