import { inject, injectable } from 'inversify';
import FindByIdUserCommand from '../../Commands/User/FindByIdUserCommand';
import INTERFACES from '../../../Infraestructure/DI/types';
import { EntityNotFound } from '../../../Infraestructure/Errors/EntityNotFound';
import IUserRepository from '../../../Domain/Interfaces/IUserRepository';
import User from '../../../Domain/Entities/User';

@injectable()
class FindByIdUserHandler {
  private readonly repository: IUserRepository;
  constructor(@inject(INTERFACES.IUserRepository) repository: IUserRepository) {
    this.repository = repository;
  }
  public async execute(command: FindByIdUserCommand): Promise<User> {
    const user = await this.repository.FindById(command.getId());

    if (!user) {
      throw new EntityNotFound(`user not found with id ${command.getId()}`);
    } else {
      return user;
    }
  }
}

export default FindByIdUserHandler;
