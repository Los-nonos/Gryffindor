import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import DeleteHostelCommand from '../../Commands/Hostel/DeleteHostelCommand';

@injectable()
class DeleteHostelHandler {
  constructor() {}
  public async execute(command: DeleteHostelCommand): Promise<any> {}
}

export default DeleteHostelHandler;
