import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import CreateHostelCommand from '../../Commands/Hostel/CreateHostelCommand';

@injectable()
class CreateHostelHandler {
  constructor() {}
  public async execute(command: CreateHostelCommand): Promise<any> {}
}

export default CreateHostelHandler;
