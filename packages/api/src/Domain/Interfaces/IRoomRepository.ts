import Room from '../Entities/Room';

export default interface IRoomRepository {
  FindById(id: number): Promise<Room>;
  Find(params: any): Promise<Room[]>;
  FindByName(name: string): Promise<Room>;
  Persist(t: Room): Promise<Room>;
  Update(t: Room): Promise<void>;
  Delete(t: Room): Promise<void>;
}
