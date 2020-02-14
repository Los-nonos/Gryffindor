import { inject, injectable } from 'inversify';
import FindUserCommand from '../../Commands/User/FindUserCommand';
import INTERFACES from '../../../Infraestructure/DI/types';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';
import IUserRepository from '../../../Domain/Interfaces/IUserRepository';
import User from '../../../Domain/Entities/User';

@injectable()
class FindUserHandler {
  private readonly repository: IUserRepository;
  constructor(@inject(INTERFACES.IUserRepository) repository: IUserRepository) {
    this.repository = repository;
  }
  public async execute(command: FindUserCommand): Promise<User[]> {
    const users = await this.repository.Find({
      Name: command.getName(),
      Phone: command.getPhone(),
      Email: command.getEmail(),
    });

    if (!users) {
      throw new EntityNotFound('');
    } else {
      return users;
    }
  }
}

export default FindUserHandler;
