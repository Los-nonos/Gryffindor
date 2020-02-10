import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import FindByIdHostelCommand from '../../Commands/Hostel/FindByIdHostelCommand';

@injectable()
class FindByIdHostelHandler {
  constructor() {}
  public async execute(command: FindByIdHostelCommand): Promise<any> {}
}

export default FindByIdHostelHandler;
