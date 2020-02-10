import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import FindHostelCommand from '../../Commands/Hostel/FindHostelCommand';

@injectable()
class FindHostelHandler {
  constructor() {}
  public async execute(command: FindHostelCommand): Promise<any> {}
}

export default FindHostelHandler;
