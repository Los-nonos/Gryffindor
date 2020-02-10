import { Request, Response } from 'express';
import { inject, injectable } from 'inversify';
import FindRoomCommand from '../../Commands/Room/FindRoomCommand';

@injectable()
class FindRoomHandler {
  constructor() {}
  public async execute(command: FindRoomCommand): Promise<any> {}
}

export default FindRoomHandler;
