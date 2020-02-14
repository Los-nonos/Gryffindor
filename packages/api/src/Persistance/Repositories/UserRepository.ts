import User from '../../Domain/Entities/User';
import { getRepository, Repository } from 'typeorm';
import IUserRepository from '../../Domain/Interfaces/IUserRepository';
import { EntityNotFound } from '../../Infraestructure/Errors/EntityNotFound';

class UserRepository implements IUserRepository {
  private repository: Repository<User>;

  constructor() {
    this.repository = getRepository(User);
  }

  public async FindById(id: number): Promise<User> {
    return await this.repository.findOne({ Id: id });
  }

  public async Find(): Promise<User[]> {
    return await this.repository.find();
  }

  public async Persist(t: User): Promise<User> {
    return await this.repository.save(t);
  }

  public async Update(t: User): Promise<void> {
    const result = await this.repository.update({ Id: t.Id }, t);
    if (!result.affected) {
      throw new EntityNotFound('');
    }
  }

  public async Delete(t: User): Promise<void> {
    const result = await this.repository.remove(t);
    if (!result) {
      throw new EntityNotFound('');
    }
  }
}

export default UserRepository;
