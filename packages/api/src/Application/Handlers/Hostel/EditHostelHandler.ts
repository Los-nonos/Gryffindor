import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import EditHostelCommand from '../../Commands/Hostel/EditHostelCommand';

@injectable()
class EditHostelHandler {
  constructor() {}
  public async execute(command: EditHostelCommand): Promise<any> {}
}

export default EditHostelHandler;
